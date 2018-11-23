# Télécharger la dernière release
```bash
git clone -b V0.1.1 https://github.com/Maraaghib/conduite-de-projet.git</br>
```
ou télécharger le .zip directement sur le site des [releases](https://github.com/Maraaghib/conduite-de-projet/releases)

# Installation
```bash
cd conduite-de-projet/Docker</br>
docker-compose up -d --build</br>
xdg-open http://localhost:8100/
```
Si vous obtenez un *connection refused* lorsque vous tentez d'accéder au site juste après un docker-compose up attendez une dizaine de secondes et rafraîchissez la page
