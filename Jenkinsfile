pipeline {
    agent any 
    stages {
        stage('build') {
            sh 'docker compose -f docker-compose.yml build'
        }

        stage ('publish') {
            sh 'docker compose -f docker-compose.yml up -d'
        }
    }

    post { 
        always {
            sh 'docker compose down --remove-orphans'
        }
    }
}