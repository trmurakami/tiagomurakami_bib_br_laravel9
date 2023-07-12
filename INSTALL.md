## Alterar classe

TeamTNT\TNTSearch\Classifier\TNTClassifier

    function softmax(array $v){

        //Just in case values are passed in as string, apply floatval
        $v = array_map('exp',array_map('floatval',$v));
        $sum = array_sum($v);
    
        foreach($v as $index => $value) {
            $v[$index] = $value/$sum;
        }
    
        return $v;
    }

    public function predict($statement)
    {
        $words = $this->tokenizer->tokenize($statement);
    
        $best_likelihoods = [];
        $best_likelihood = -INF;
        $best_type       = '';
        foreach ($this->types as $type) {
            $best_likelihoods[$type] = -INF;
            $likelihood = log($this->pTotal($type)); // calculate P(Type)
            $p          = 0;
            foreach ($words as $word) {
                $word = $this->stemmer->stem($word);
                $p += log($this->p($word, $type));
            }
            $likelihood += $p; // calculate P(word, Type)
            if ($likelihood > $best_likelihood) {
                $best_likelihood = $likelihood;
                $best_likelihoods[$type] = $likelihood;
                $best_type       = $type;
            }
        }
    
        return [
            'likelihood' => $best_likelihood,
            'likelihoods' => $best_likelihoods,
            'probability' => $this->softmax($best_likelihoods),
            'label'      => $best_type
        ];
    }