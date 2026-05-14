# TravelWorld2

# DevOps Project: Travel Website Deployment

## 1. Project Overview
This project demonstrates end-to-end deployment of a travel website using modern DevOps tools including Git, Ansible, Docker, Jenkins, Kubernetes, and AWS (EC2 & EKS). The Cluster objects like Nodes, Pods and Cluster usage of CPU is also demonstrated using Grafana and Prometheus.

## 2. GitHub Repository Structure
kubernetes/
├── Ansible/
│ ├── installation.yaml
│ └── inventory.yaml
├── frontend/
│ ├── Dockerfile
│ ├── index.html
│ ├── script.js
│ └── style.css
├── backend/
│ ├── api.php
│ └── Dockerfile
├── k8s/
│ ├── backend-deployment.yaml
│ ├── backend-service.yaml
│ ├── frontend-deployment.yaml
│ └── frontend-service.yaml
└── Jenkinsfile

This is a multi-branch project in which there are 3 branches: main, frontdev (codes pushed by frontend developer) and backdev (code pushed by backened developer). Collaboratores are added to approve the codes update and there approving authority is assigned so that PR for frontend and backend codes will be forwarded to the respective collaborator


---

## 3. Project Flow Architecture

Developer pushes code to GitHub ---> PR generation (manually) ---> PR forwarded and approved by collaborators ----> Branch merger to main (manually)---->Jenkins pulls files ----> Builds Docker images ---> Pushes images to DockerHub → Deployment by  EKS cluster → Website accessible to server via LoadBalancer

---

## 4. Tools & Technologies Used

- **Git** – Version control  

- **Ansible** – Configuration  
  Ansible is used to install Docker and Kubernetes tools (kubeadm, kubectl, kubelet) and prepare the system by disabling swap and   enabling Docker service.  

- **Docker** – Containerization  
  Frontend and backend applications are containerized using Docker. For frontend application nginx image and for backend application Apache server with PHP is used. Code is copied into `/var/www/html` and exposed on port 80.  

- **Jenkins** – Run CI/CD pipeline  

- **Kubernetes** – Container orchestration: Frontend and backend are deployed using Kubernetes Deployments.  
    - Frontend → LoadBalancer  
    - Backend → ClusterIP  

- **AWS EC2** – Virtual servers  

- **AWS EKS** – Managed Kubernetes cluster

- **Grafana & prometheus** - Observebility

---

## 5. Jenkins CI/CD Pipeline: Pipeline stages include:
  
1. SonarQube code analysis  
2. Docker image build  
3. Security scans using Trivy  
4. Push images to DockerHub  
5. Deploy to AWS EKS cluster    

---

## 6. Screenshots

- Jenkins Pipeline
- ![Jenkins pipeline](screenshots/jenkinspipeline_20260408-232141_Chrome.jpg)
- Kubernetes Pods and Services
- ![kubernetes Pods & SVC](screenshots/pods_svc_20260408-233015_Termius.jpg)
- AWS EKS Cluster
- ![EKS Cluster](screenshots/eks_cluster_20260408-233311_Chrome.jpg)
- Website Output
- ![Website Page](screenshots/websitepage1_20260408-231544_Chrome.jpg)
- ![Website Page 2](screenshots/websitepage2_20260408-231606_Chrome.jpg)
- DockerHub Images
- ![DockerHub](screenshots/dockerhub_20260408-233236_Chrome.jpg)

---

### 7.Challenges and Solutions

# 1. SonarQube Analysis Issue
**Error:** Failed to query server version: HTTP connect timed out  

**Solution:**  
Manage Jenkins → System → SonarQube Installation → Update URL  

Since EC2 public IP changes (no Elastic IP), update URL: http://<public-ip>:9000

# 2. Trivy Not Found
**Error:** trivy: not found  

**Solution:**  
Installed Trivy using official documentation: https://trivy.dev/  

# 3. Kubectl Configuration Issue
**Error:**  
The connection to the server 127.0.0.1:34897 was refused  

**Reason:**  
kubectl was not connected to EKS cluster (missing kubeconfig)

**Solution:** command: aws eks --region ap-south-1 update-kubeconfig --name ekscluster
Then verify: "kubectl get pods" & "kubectl get svc"


---

## 8. Conclusion

This project demonstrates a complete DevOps lifecycle including CI/CD, containerization, orchestration, and deployment on AWS cloud.

## 9. GitHub Repository:   https://github.com/Qazaidi123/ExploreWorldFinal
