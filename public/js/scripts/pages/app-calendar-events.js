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

var events = [];

function getEvents() {
    return fetch('http://127.0.0.1:8000/voyagesJson')
        .then((response) => response.json())
        .then((data) => {
            // Mettre à jour le tableau events avec les nouvelles données sssss
            events = data.map((item) => ({
                id: item.id,
                url: 'http://127.0.0.1:8000/voyages/show/' + item.id,
                title: `${item.lieu_depart}-${item.lieu_arrive}`, // Vous pouvez définir le titre en fonction de vos besoins
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

