import re

def decode_message(instruction, encrypted_message):
    pattern = "{1,3}?".join([char for char in instruction]) + "{1,3}?"
    return re.search(pattern, encrypted_message) != None

def process_file():
    with open("input.txt") as input_file:
        lines_count = len(input_file.readline().strip().split(' '))
        lines = input_file.readlines(lines_count - 1)

        instructions = lines[:-1]

        encrypted_message = lines[-1:]

        with open("output.txt", "w") as output_file:
            for i in range(len(instructions)):
                contains_instruction = ('NO', 'SI')[decode_message(instructions[i].strip(), encrypted_message[0])]
                output_file.write(contains_instruction + ("\n", "")[i == len(instructions) - 1])
        
process_file()
