<?php

namespace App\Services;

use Phpml\Classification\NaiveBayes;
use Phpml\Preprocessing\Normalizer;
use Phpml\Tokenization\WordTokenizer;
use Phpml\FeatureExtraction\StopWords;
use Phpml\FeatureExtraction\TfIdfTransformer;

class NaiveBayesService
{

    static function preprocessing($data)
    {
        $tokenizing = self::tokenizing($data);

        // $stopwords = self::stopwords($tokenizing);

        return $tokenizing;
    }

    static function tokenizing($data)
    {
        // create the WordTokenizer object
        $tokenizer = new WordTokenizer();

        // tokenize the samples
        $tokenized_samples = [];
        foreach ($data as $sample) {
            $tokenized_samples[] = $tokenizer->tokenize($sample->kalimat);
            $labels[] = $sample->kategori;
        }

        $data = [
            'tokenized_data' => $tokenized_samples,
            'kategori' => $labels
        ];

        return $data;
    }
    static function stopwords($data)
    {
        // create the StopWords object
        $stopWords = new StopWords([]);

        // remove stop words from the tokenized samples
        return $stopWords->remove($data);
    }
    static function tfid()
    {
    }
}
