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
                sh 'docker exec -it showcase_app php artisan test'
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
