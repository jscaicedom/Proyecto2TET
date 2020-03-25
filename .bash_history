sudo amazon-linux-extras install docker
sudo yum install git
sudo systemctl enable docker
sudo systemctl start docker
sudo usermod -a -G docker ec2-user
sudo curl -L https://github.com/docker/compose/releases/download/1.24.0-rc1/docker-compose-`uname -s`-`uname -m` -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose
mkdir word
cd word/
sudo nano docker-compose.yml
sudo `which docker-compose` up -d
cd ..
ls
cd word/
ls
cd src
ls
