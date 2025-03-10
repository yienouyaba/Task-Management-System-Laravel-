package desktop_app;

import javax.swing.*;
import java.awt.*;
import java.util.List;

public class TaskManagerFrame extends JFrame {
    public TaskManagerFrame() {
        setTitle("Gestion des tâches");
        setSize(500, 400);
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setLayout(new BorderLayout());

        JList<String> taskList = new JList<>();
        add(new JScrollPane(taskList), BorderLayout.CENTER);

        JButton refreshButton = new JButton("Actualiser");
        refreshButton.addActionListener(e -> {
            List<String> tasks = APIClient.getTasks();
            taskList.setListData(tasks.toArray(new String[0]));
        });
        add(refreshButton, BorderLayout.SOUTH);

        setVisible(true);
    }
    public static void main(String[] args) {
        new TaskManagerFrame();
    }

}
