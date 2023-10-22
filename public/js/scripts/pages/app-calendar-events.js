/**
 * App Calendar Events
 */

'use strict';

var date = new Date();
var nextDay = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
// prettier-ignore
var nextMonth = date.getMonth() === 11 ? new Date(date.getFullYear() + 1, 0, 1) : new Date(date.getFullYear(), date.getMonth() + 1, 1);
// prettier-ignore
var prevMonth = date.getMonth() === 11 ? new Date(date.getFullYear() - 1, 0, 1) : new Date(date.getFullYear(), date.getMonth() - 1, 1);

var events = [   {
  id: 2,
  url: '',
  title: 'sousse-kairaouen',
  start: new Date(date.getFullYear(), date.getMonth() + 1, -12),
  end: new Date(date.getFullYear(), date.getMonth() + 1, -11),
  allDay: false,
  extendedProps: {
    calendar: 'Business'
  }
},
  {
    id: 2,
    url: '',
    title: 'tunis-sfax',
    start: new Date(date.getFullYear(), date.getMonth() + 1, -11),
    end: new Date(date.getFullYear(), date.getMonth() + 1, -10),
    allDay: false,
    extendedProps: {
      calendar: 'Business'
    }},
  {
    id: 2,
    url: '',
    title: 'bizerte-kairaouen',
    start: new Date(date.getFullYear(), date.getMonth() + 1, -4),
    end: new Date(date.getFullYear(), date.getMonth() + 1, -3),
    allDay: false,
    extendedProps: {
      calendar: 'Business'
    }},
  {
    id: 2,
    url: '',
    title: 'tataouin-sousse',
    start: new Date(date.getFullYear(), date.getMonth() + 1, -1),
    end: new Date(date.getFullYear(), date.getMonth() + 1, -0),
    allDay: false,
    extendedProps: {
      calendar: 'Business'
    }},
  {
    id: 2,
    url: '',
    title: 'nabeul-kairaouen',
    start: new Date(date.getFullYear(), date.getMonth() + 1, -20),
    end: new Date(date.getFullYear(), date.getMonth() + 1, -19),
    allDay: false,
    extendedProps: {
      calendar: 'Business'
    },
  }
    ];

function getEvents() {
    return fetch('http://127.0.0.1:8000/voyagesJson')
        .then((response) => response.json())
        .then((data) => {
            // Mettre à jour le tableau events avec les nouvelles données sssss
            events = data.map((item) => ({
                id: item.id,
                url: 'http://127.0.0.1:8000/voyages/show/' + item.id,
                title: `${item.lieu_depart}-${item.lieu_arrive}`, // Vous pouvez définir le titre en fonction de vos besoinssss
                start: new Date(item.date_voyage),
                end: new Date(item.date_voyage), // Vous pouvez ajuster cela en fonction de vos besoins
                allDay: false, // Vous devrez définir cela en fonction de votre logique
                extendedProps: {
                    calendar: 'Business',
                    // Vous pouvez également ajouter d'autres propriétés étendues en fonction de vos besoins
                },
            }));

            console.log(events);
        })
        .catch((error) => {
            console.error('Erreur lors de la récupération des données :', error);
        });
}

// Appelez la fonction pour récupérer les données et mettre à jour le tableau events
getEvents();

