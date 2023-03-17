<?php

namespace App\Services;

use App\Models\KataDihilangkan;
use Phpml\Classification\NaiveBayes;
use Phpml\Preprocessing\Normalizer;
use Phpml\Tokenization\WordTokenizer;
use Phpml\FeatureExtraction\StopWords;
use Phpml\FeatureExtraction\TfIdfTransformer;
use Sastrawi\Stemmer\StemmerFactory;
use stdClass;

class NaiveBayesService
{

    private static $classes = array("positif", "negatif", "netral");
    private static $vocabulary = array();
    private static $classCounts = array("positif" => 0, "negatif" => 0, "netral" => 0);

    public static function train($text, $class)
    {
        $words = explode(" ", $text);
        if (!in_array($class, self::$classes)) {
            return "Invalid class";
        }
        self::$classCounts[$class]++;
        foreach ($words as $word) {
            if (!array_key_exists($word, self::$vocabulary)) {
                self::$vocabulary[$word] = array("positif" => 0, "negatif" => 0, "netral" => 0);
            }
            self::$vocabulary[$word][$class]++;
        }

        return self::$classCounts[$class];
    }

    public static function classify($text, $username, $testing_detil_id)
    {
        $words = explode(" ", $text);
        $scores = array("positif" => 0, "negatif" => 0, "netral" => 0);

        if (array_sum(self::$classCounts) === 0) {
            return "Error: no training data provided.";
        }

        foreach (self::$classes as $class) {
            $scores[$class] = log(self::$classCounts[$class] / array_sum(self::$classCounts));
            foreach ($words as $word) {
                if (array_key_exists($word, self::$vocabulary)) {
                    $scores[$class] += log((self::$vocabulary[$word][$class] + 1) / (self::$classCounts[$class] + count(self::$vocabulary)));
                } else {
                    $scores[$class] += log(1 / (self::$classCounts[$class] + count(self::$vocabulary)));
                }
            }
        }

        $arr = [
            'testing_detil_id' => $testing_detil_id,
            'kalimat' => $text,
            'username' => $username,
            'skor' => ucfirst(array_keys($scores, max($scores))[0]),
        ];

        return $arr;
    }

    static function preprocessing($data, $type = 0)
    {


        if ($type == 0) {
            $tokenizing = self::train_tokenizing($data);

            $stemming = self::stemming($tokenizing['data']);

            $stopwords = self::stopwords($stemming);

            $union = self::union($stopwords);

            return [
                'data' => $union,
                'label' => $tokenizing['kategori']
            ];
        } else {

            $cleansing = self::cleansing($data);

            $casefolding = self::casefolding($cleansing);

            $tokenizing = self::classify_tokenizing($casefolding);

            $stemming = self::stemming($tokenizing['data']);

            $stopwords = self::stopwords($stemming);

            $union = self::union($stopwords);

            $pre_data = [
                'cleansing' => $cleansing,
                'casefolding' => $casefolding,
                'tokenizing' => $tokenizing,
                'stopwords' => $stopwords,
                'stemming' => $stemming,
                'union' => $union,
            ];

            $prepocessing = self::combine($pre_data);

            return [
                'data' => $data,
                'pre' => $prepocessing,
                'username' => $tokenizing['username'],
                'testing_detil_id' => $tokenizing['testing_detil_id'],
            ];
        }
    }

    static function train_tokenizing($data)
    {
        // create the WordTokenizer object
        $tokenizer = new WordTokenizer();

        // tokenize the samples
        $tokenized_samples = [];
        foreach ($data as $sample) {
            $tokenized_samples[] = $tokenizer->tokenize($sample->kalimat);
            $labels[] = strtolower($sample->kategori);
        }

        $data = [
            'data' => $tokenized_samples,
            'kategori' => $labels
        ];

        return $data;
    }

    static function classify_tokenizing($data)
    {
        // create the WordTokenizer object
        $tokenizer = new WordTokenizer();

        // tokenize the samples
        $tokenized_samples = [];
        $username_twitter = [];
        $testing_detil_id = [];
        foreach ($data as $sample) {
            $tokenized_samples[] = $tokenizer->tokenize($sample->post);
            $username_twitter[] = $sample->username_twitter;
            $testing_detil_id[] = $sample->id;
        }

        $data = [
            'data' => $tokenized_samples,
            'username' => $username_twitter,
            'testing_detil_id' => $testing_detil_id,
        ];

        return $data;
    }

    static function cleansing($data)
    {
        $arr = [];
        foreach ($data as $row) {

            $clean = self::cleanwords($row->post);

            $temp = new stdClass;
            $temp->id = $row->id;
            $temp->testing_id = $row->testing_id;
            $temp->post = $clean;
            $temp->username_twitter = $row->username_twitter;

            $arr[] = $temp;
        }

        return $arr;
    }

    static function casefolding($data)
    {
        $arr = [];
        foreach ($data as $row) {

            $lower = strtolower($row->post);

            $temp = new stdClass;
            $temp->id = $row->id;
            $temp->testing_id = $row->testing_id;
            $temp->post = $lower;
            $temp->username_twitter = $row->username_twitter;

            $arr[] = $temp;
        }

        return $arr;
    }

    static function stopwords($data)
    {
        $arrstopwords = [];
        $datastopwords = KataDihilangkan::all(['kata']);
        foreach ($datastopwords as $row) {
            $arrstopwords[] = $row->kata;
        }

        $arrdata = [];

        foreach ($data as $val) {

            $rowdata = self::removewords($val, $arrstopwords);

            $arrdata[] = $rowdata;
        }

        return $arrdata;
    }

    static function stemming($data)
    {
        // create the Stemmer object
        $stemmerFactory = new StemmerFactory();
        $stemmer  = $stemmerFactory->createStemmer();

        // stem the tokenized samples
        $stemmed_samples = [];
        foreach ($data as $sample) {
            $stemmed_sample = [];
            foreach ($sample as $word) {
                $stemmed_sample[] = $stemmer->stem($word);
            }
            $stemmed_samples[] = $stemmed_sample;
        }

        return $stemmed_samples;
    }

    static function union($data)
    {
        $arr = [];
        foreach ($data as $row) {
            $unitext = "";
            foreach ($row as $key => $text) {
                $separator = " ";
                if ($key + 1 === count($row)) {
                    $separator = "";
                }
                $unitext .= $text . $separator;
            }

            $arr[] = $unitext;
        }

        return $arr;
    }

    static function combine($pre)
    {

        $count = count($pre['union']);

        $arr = [];

        for ($i = 0; $i < $count; $i++) {

            $temp = new stdClass;
            $temp->username = $pre['cleansing'][$i]->username_twitter;
            $temp->cleansing = $pre['cleansing'][$i]->post;
            $temp->casefolding = $pre['casefolding'][$i]->post;
            $temp->tokenizing = json_encode($pre['tokenizing']['data'][$i]);
            $temp->stopwords = json_encode($pre['stopwords'][$i]);
            $temp->stemming = json_encode($pre['stemming'][$i]);
            $temp->union = $pre['union'][$i];

            $arr[] = $temp;
        }

        return $arr;
    }


    // Private
    private static function removewords($arrtext, $arrstopwords)
    {
        foreach ($arrtext as $i => $text) {
            if (in_array($text, $arrstopwords)) {
                unset($arrtext[$i]);
            }
        }
        $newarr = [];
        foreach ($arrtext as $text) {
            $newarr[] = strtolower($text);
        }

        return $newarr;
    }

    private static function cleanwords($text)
    {

        // Remove phone numbers
        $text = preg_replace('/\d{3}-\d{3}-\d{4}/', '', $text);

        // Remove email addresses
        $text = preg_replace('/\S+@\S+\.\S+/', '', $text);

        // Remove punctuation marks
        $text = preg_replace('/[^\w\s]/', '', $text);

        // Remove extra whitespace
        $text = preg_replace('/\s+/', ' ', $text);

        return $text;
    }
}
