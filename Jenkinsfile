pipeline {
    agent any 
    stages {
        stage('test and build') { 
            steps {
                withMaven(maven : 'practice'){
                    sh 'mvn clean compile'

                }
                
            }
        }
        stage('for pracice testing') { 
            steps {
                withMaven(practice){
                    sh 'mvn test'
                }
            }
        }
        stage('Deploy') { 
            steps {
                withMaven(maven : 'practice'){
                    sh 'mvn deploy'
                }
            }
        }
    }
}
