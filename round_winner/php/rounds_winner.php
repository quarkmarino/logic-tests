<?php

function rounds_winner($input_file_name = 'input.txt', $output_file_name = 'output.txt'){
    $max_advantages = [0, 0];
    $input_file = new SplFileObject($input_file_name);
    
    $rounds_num = $input_file->fgets();

    while (!$input_file->eof()) {
        $round = trim($input_file->fgets());

        $scores = explode(' ', $round);

        $diff = $scores[0] - $scores[1];

        if($diff >= 0){
            $max_advantages[0] = max($max_advantages[0], $diff);
        }
        
        if($diff <= 0){
            $max_advantages[1] = max($max_advantages[1], -$diff);
        }
    }

    $winner = $max_advantages[0] > $max_advantages[1] ? '1 '.$max_advantages[0] : '2 '.$max_advantages[1];

    (new SplFileObject($output_file_name, 'w+'))->fwrite($winner);
}

rounds_winner('input.txt', 'output.txt');