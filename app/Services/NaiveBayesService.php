<?php

namespace App\Services;

use App\Models\KataDihilangkan;
use Phpml\Classification\NaiveBayes;
use Phpml\Preprocessing\Normalizer;
use Phpml\Tokenization\WordTokenizer;
use Phpml\FeatureExtraction\StopWords;
use Phpml\FeatureExtraction\TfIdfTransformer;
use Sastrawi\Stemmer\StemmerFactory;

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

    public static function classify($text,$username,$testing_detil_id)
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
            $tokenizing = self::classify_tokenizing($data);

            $stemming = self::stemming($tokenizing['data']);

            $stopwords = self::stopwords($stemming);

            $union = self::union($stopwords);

            return [
                'data' => $union,
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
}
