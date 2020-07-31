<?php

function decode_message($instruction, $encoded_message){
    $pattern = implode('{1,3}?', str_split($instruction)).'{1,3}?';

    return preg_match('/'.$pattern.'/', $encoded_message);
}

function process_file($input_file_name = 'input.txt', $output_file_name = 'output.txt'){
    $input_file = new SplFileObject($input_file_name);
    $output_file = new SplFileObject($output_file_name, 'w+');

    $lines_count = get_instructions_book_count($input_file);

    $encripted_message = get_encripted_message($input_file, $lines_count);

    for($i = 1; $i < $lines_count; $i++){
        $instruction = trim($input_file->current());

        $contains_instruction = decode_message($instruction, $encripted_message) ? 'SI' : 'NO';

        $output_file->fwrite($contains_instruction.($i == $lines_count - 1 ? '' : "\n"));
        $input_file->next();
    }
}

// get the instructions book count
function get_instructions_book_count(SplFileObject $input_file)
{
    $input_file->rewind();

    $sizes_line = trim($input_file->current());

    $sizes = explode(' ', $sizes_line);

    return count($sizes);
}

// reads encripted message from last line
function get_encripted_message(SplFileObject $input_file, int $lines_count): string
{
    $input_file->seek($lines_count);

    $encripted_message = trim($input_file->current());

    $input_file->seek(1);

    return $encripted_message;
}

process_file('input.txt', 'output.txt');