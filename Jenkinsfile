pipeline {
    agent any 
    stages {
        stage('build') {
            steps {
                sh 'docker compose -f docker-compose.yml build'
            }
        }

        stage ('publish') {
            steps {
                sh 'docker compose -f docker-compose.yml up -d'
            }
        }
    }
}