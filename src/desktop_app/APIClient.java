package desktop_app;

import java.io.*;
import java.net.*;
import java.util.*;
import org.json.*;

public class APIClient {
    private static final String BASE_URL = "http://localhost:8000/api/";

    public static boolean login(String email, String password) {
        try {
            URL url = new URL(BASE_URL + "login");
            HttpURLConnection conn = (HttpURLConnection) url.openConnection();
            conn.setRequestMethod("POST");
            conn.setRequestProperty("Content-Type", "application/json");
            conn.setDoOutput(true);

            String jsonInputString = new JSONObject().put("email", email).put("password", password).toString();
            try (OutputStream os = conn.getOutputStream()) {
                os.write(jsonInputString.getBytes());
                os.flush();
            }

            return conn.getResponseCode() == 200;
        } catch (Exception e) {
            return false;
        }
    }

    public static List<String> getTasks() {
        List<String> taskList = new ArrayList<>();
        try {
            URL url = new URL(BASE_URL + "tasks");
            HttpURLConnection conn = (HttpURLConnection) url.openConnection();
            conn.setRequestMethod("GET");

            try (BufferedReader br = new BufferedReader(new InputStreamReader(conn.getInputStream()))) {
                String response = br.readLine();
                JSONArray jsonArray = new JSONArray(response);
                for (int i = 0; i < jsonArray.length(); i++) {
                    taskList.add(jsonArray.getJSONObject(i).getString("title"));
                }
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
        return taskList;
    }
}
