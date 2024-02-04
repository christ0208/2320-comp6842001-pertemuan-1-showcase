node {
    stages {
        stage('build') {
            steps {
                sh 'docker compose -f docker-compose.yml up -d --build'
            }
        }
    }
}