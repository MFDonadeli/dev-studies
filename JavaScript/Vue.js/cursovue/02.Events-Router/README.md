Main.js loads router and storage

Mains screen is App.js

The top of the system has the component NavBar with the links (all pages)

Event List also load because it's / (the content and others are shown inside <router-view />  that is inside App.js)

Event List load EventService that loads data from json

json provider: json-server --watch db.json

