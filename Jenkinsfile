pipeline {
    agent any 
    stages {
        stage('test') {
            environment {
                DB_HOST = "showcase"
                DB_DATABASE = "showcase"
                DB_USERNAME = "showcase"
                DB_PASSWORD = "showcase"
            }
            steps {
                sh 'docker compose start db'
                sh 'php --version'
                sh 'composer --version'
                sh 'composer install'
                sh 'echo DB_HOST=${DB_HOST} >> .env'
                sh 'echo DB_USERNAME=${DB_USERNAME} >> .env'
                sh 'echo DB_DATABASE=${DB_DATABASE} >> .env'
                sh 'echo DB_PASSWORD=${DB_PASSWORD} >> .env'
                sh 'php artisan key:generate'
                sh 'php artisan migrate:refresh --force'
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
