var ganttTasks = [
    {
        "ID": 7,
        "Title": "Software validation, research and implementation",
        "ParentID": null,
        "OrderID": 0,
        "Start": new Date("2020/6/1 3:00"),
        "End": new Date("2020/6/18 3:00"),
        "PlannedStart": new Date("2020/6/1 3:00"),
        "PlannedEnd": new Date("2020/6/12 3:00"),
        "PercentComplete": 0.43,
        "Summary": true,
        "Expanded": true,
        "TeamLead": "Darrel Solis"
    },
    {
        "ID": 18,
        "Title": "Project Kickoff",
        "ParentID": 7,
        "OrderID": 0,
        "Start": new Date("2020/6/1 3:00"),
        "End": new Date("2020/6/1 3:00"),
        "PlannedStart": new Date("2020/6/1 3:00"),
        "PlannedEnd": new Date("2020/6/1 3:00"),
        "PercentComplete": 0.23,
        "Summary": false,
        "Expanded": true,
        "TeamLead": "Mallory Gilliam"
    },
    {
        "ID": 13,
        "Title": "Implementation",
        "ParentID": 7,
        "OrderID": 1,
        "Start": new Date("2020/6/3 3:00"),
        "End": new Date("2020/6/17 3:00"),
        "PlannedStart": new Date("2020/6/2 3:00"),
        "PlannedEnd": new Date("2020/6/17 3:00"),
        "PercentComplete": 0.77,
        "Summary": true,
        "Expanded": true,
        "TeamLead": "Mia Caldwell"
    },
    {
        "ID": 24,
        "Title": "Prototype",
        "ParentID": 13,
        "OrderID": 0,
        "Start": new Date("2020/6/3 3:00"),
        "End": new Date("2020/6/5 3:00"),
        "PlannedStart": new Date("2020/6/3 3:00"),
        "PlannedEnd": new Date("2020/6/6 3:00"),
        "PercentComplete": 0.77,
        "Summary": false,
        "Expanded": true,
        "TeamLead": "Drew Mckay"
    },
    {
        "ID": 26,
        "Title": "Architecture",
        "ParentID": 13,
        "OrderID": 1,
        "Start": new Date("2020/6/5 3:00"),
        "End": new Date("2020/6/7 3:00"),
        "PlannedStart": new Date("2020/6/4 3:00"),
        "PlannedEnd": new Date("2020/6/6 3:00"),
        "PercentComplete": 0.82,
        "Summary": false,
        "Expanded": true,
        "TeamLead": "Zelda Medina"
    },
    {
        "ID": 27,
        "Title": "Data Layer",
        "ParentID": 13,
        "OrderID": 2,
        "Start": new Date("2020/6/7 3:00"),
        "End": new Date("2020/6/9 3:00"),
        "PlannedStart": new Date("2020/6/6 3:00"),
        "PlannedEnd": new Date("2020/6/9 3:00"),
        "PercentComplete": 1.00,
        "Summary": false,
        "Expanded": true,
        "TeamLead": "Olga Strong"
    },
    {
        "ID": 28,
        "Title": "Unit Tests",
        "ParentID": 13,
        "OrderID": 4,
        "Start": new Date("2020/6/14 3:00"),
        "End": new Date("2020/6/17 3:00"),
        "PlannedStart": new Date("2020/6/10 3:00"),
        "PlannedEnd": new Date("2020/6/12 3:00"),
        "PercentComplete": 0.68,
        "Summary": false,
        "Expanded": true,
        "TeamLead": "Christian Palmer"
    },
    {
        "ID": 29,
        "Title": "UI and Interaction",
        "ParentID": 13,
        "OrderID": 5,
        "Start": new Date("2020/6/7 3:00"),
        "End": new Date("2020/6/11 3:00"),
        "PlannedStart": new Date("2020/6/6 3:00"),
        "PlannedEnd": new Date("2020/6/9 3:00"),
        "PercentComplete": 0.60,
        "Summary": false,
        "Expanded": true,
        "TeamLead": "Moses Duncan"
    }
];