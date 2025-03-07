import pandas as pd
import matplotlib.pyplot as plt
import seaborn as sns
import requests
import logging
from datetime import datetime, timedelta
import json

# Configuration des logs
logging.basicConfig(level=logging.INFO, format="%(asctime)s - %(levelname)s - %(message)s")

class TaskReporting:
    def __init__(self, api_url="http://localhost:8000/api"):
        self.api_url = api_url
        self.auth_token = None
    
    def authenticate(self, username, password):
        """Authentification à l'API pour récupérer un token"""
        try:
            response = requests.post(f"{self.api_url}/login", json={"email": username, "password": password}, timeout=10)
            response.raise_for_status()
            self.auth_token = response.json().get("token")
            if self.auth_token:
                logging.info("Authentification réussie.")
                return True
        except requests.exceptions.RequestException as e:
            logging.error(f"Erreur d'authentification : {e}")
        return False
    
    def get_tasks(self):
        """Récupérer toutes les tâches depuis l'API"""
        if not self.auth_token:
            logging.error("Vous devez être authentifié.")
            return []
        
        headers = {"Authorization": f"Bearer {self.auth_token}"}
        try:
            response = requests.get(f"{self.api_url}/tasks", headers=headers, timeout=10)
            response.raise_for_status()
            tasks = response.json()
            logging.info(f"{len(tasks)} tâches récupérées.")
            return tasks
        except requests.exceptions.RequestException as e:
            logging.error(f"Erreur lors de la récupération des tâches : {e}")
            return []
    
    def get_projects(self):
        """Récupérer tous les projets depuis l'API"""
        if not self.auth_token:
            logging.error("Vous devez être authentifié.")
            return []
        
        headers = {"Authorization": f"Bearer {self.auth_token}"}
        try:
            response = requests.get(f"{self.api_url}/projects", headers=headers, timeout=10)
            response.raise_for_status()
            projects = response.json()
            logging.info(f"{len(projects)} projets récupérés.")
            return projects
        except requests.exceptions.RequestException as e:
            logging.error(f"Erreur lors de la récupération des projets : {e}")
            return []
    
    def tasks_to_dataframe(self, tasks=None):
        """Convertir les tâches en DataFrame pandas pour l'analyse"""
        if tasks is None:
            tasks = self.get_tasks()
        
        df = pd.DataFrame(tasks)
        
        # Vérifier que toutes les colonnes nécessaires sont présentes
        expected_columns = ['id', 'title', 'status', 'priority', 'due_date', 'created_at', 'project_id']
        for col in expected_columns:
            if col not in df.columns:
                df[col] = None  # Ajouter les colonnes manquantes
        
        # Convertir les dates en datetime
        if 'due_date' in df.columns:
            df['due_date'] = pd.to_datetime(df['due_date'], errors='coerce')
        if 'created_at' in df.columns:
            df['created_at'] = pd.to_datetime(df['created_at'], errors='coerce')
        
        return df
    
    def generate_status_report(self, output_file="status_report.png"):
        """Générer un graphique du nombre de tâches par statut"""
        df = self.tasks_to_dataframe()
        if df.empty:
            logging.warning("Aucune tâche disponible pour générer le rapport.")
            return None
        
        plt.figure(figsize=(10, 6))
        df['status'].value_counts().plot(kind='bar', color=['blue', 'orange', 'green', 'red'])
        plt.title('Nombre de tâches par statut')
        plt.xlabel('Statut')
        plt.ylabel('Nombre de tâches')
        plt.tight_layout()
        plt.savefig(output_file)
        plt.close()
        logging.info(f"Rapport de statut sauvegardé sous {output_file}")
        return output_file
    
    def export_to_excel(self, output_file="task_report.xlsx"):
        """Exporter les données des tâches vers un fichier Excel"""
        df = self.tasks_to_dataframe()
        projects = {p['id']: p['name'] for p in self.get_projects()}
        df['project_name'] = df['project_id'].map(projects)
        
        if df.empty:
            logging.warning("Aucune tâche disponible pour exportation.")
            return None
        
        with pd.ExcelWriter(output_file, engine='xlsxwriter') as writer:
            df.to_excel(writer, sheet_name='Toutes les tâches', index=False)
        
        logging.info(f"Export des tâches effectué sous {output_file}")
        return output_file

# Exemple d'utilisation
if __name__ == "__main__":
    reporter = TaskReporting()
    if reporter.authenticate("user@example.com", "password"):
        reporter.generate_status_report()
        reporter.export_to_excel()
        logging.info("Tous les rapports ont été générés avec succès.")
    else:
        logging.error("Échec de l'authentification.")
