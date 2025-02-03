pipeline {
    agent any 
    stages {
        stage('test') {
            steps {
                sh 'php --version'
                sh 'composer --version'
                sh 'composer install'
                sh 'php artisan test'
            }
        }
        
        stage('Docker build') {
            steps {
                sh 'docker compose -f docker-compose.yml build'
            }
        }

        stage ('Docker publish') {
            steps {
                sh 'docker compose -f docker-compose.yml up -d'
            }
        }
    }
}
