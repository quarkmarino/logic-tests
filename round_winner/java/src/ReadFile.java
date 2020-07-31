import java.io.IOException;
import java.io.FileReader;
import java.io.BufferedReader;

public class ReadFile {
    private String path;

    public ReadFile(String file_path) {
        path = file_path;
    }

    public String[] OpenFile() throws IOException {
        FileReader fr = new FileReader(path);

        BufferedReader bf = new BufferedReader(fr);

        int numberOfLines = readLines();

        String[] textData = new String[numberOfLines];

        int i;

        for (i=0; i < numberOfLines; i++) {
            textData[i] = bf.readLine();
        }

        bf.close();

        return textData;
    }

    int readLines() throws IOException{
        FileReader fr = new FileReader(path);
        BufferedReader bf = new BufferedReader(fr);

        String aLine;
        int numberOfLines = 0;

        while((aLine = bf.readLine()) != null){
            numberOfLines++;
        }

        bf.close();

        return numberOfLines;
    }
}