import java.net.URI;
import java.net.URL;

public class APIClient_1 {
    private static final String BASE_URL = "https://example.com/api/";

    public void login() throws Exception {
        URI uri = URI.create(BASE_URL + "login");
        URL url = uri.toURL();
        System.out.println("URL correcte : " + url);
    }

    public void getTasks() throws Exception {
        URI uri = URI.create(BASE_URL + "tasks");
        URL url = uri.toURL();
        System.out.println("URL correcte : " + url);
    }
}
