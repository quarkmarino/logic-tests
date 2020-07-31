import java.io.IOException;

public class RoundsWinner {

    public static void main(String[] args) throws IOException{
        String inputFileName = "input.txt";
        String outputFileName = "output.txt";

        try {
            ReadFile inputFile = new ReadFile(inputFileName);
            WriteFile outputFile = new WriteFile(outputFileName, false);

            // we keep an score of the best advantages after every round
            int[] max_advantages = new int[]{0, 0};

            String[] linesArray = inputFile.OpenFile();

            String rounds_num = linesArray[0];

            for(int i = 1; i < linesArray.length; i++){
                String round = linesArray[i].replace("\n", "").replace("\r", "");

                String[] scores = round.split(" ");

                int score_1 = Integer.parseInt(scores[0]);
                int score_2 = Integer.parseInt(scores[1]);

                int advantage = score_1 - score_2;

                if(advantage >= 0){
                    max_advantages[0] = max_advantages[0] > advantage ? max_advantages[0] : advantage;
                }
                
                if(advantage <= 0){
                    max_advantages[1] = max_advantages[1] > -advantage ? max_advantages[1] : -advantage;
                }

            }

            String winner = max_advantages[0] > max_advantages[1] ? "1 "  + max_advantages[0] : "2 " + max_advantages[1];
            outputFile.writeToFile(winner);
        }
        catch(IOException e){
        }
    }
}