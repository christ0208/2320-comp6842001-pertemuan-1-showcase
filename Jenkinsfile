pipeline {
    agent any 
    stages {
        stage('build') {
            steps {
                sh 'docker compose -f docker-compose.yml build'
            }
        }

        stage('test') {
            steps {
                sh 'docker compose -f docker-compose.testing.yml up -d'
                // sh 'sleep 5 && docker exec "showcase-app" /bin/bash -c "php artisan test"'
                sh 'docker compose -f docker-compose.testing.yml down'
            }
        }

        stage ('publish') {
            steps {
                sh 'docker compose -f docker-compose.yml up -d'
            }
        }
    }
}
