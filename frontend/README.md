# Table Component with Search, Pagination, and Sort Features
This project demonstrates how to build a basic table component with search, pagination, and sort features using Vue.js Composition API. The component is built from scratch without using any existing library component. The table component receives events from the Ticketmaster API with search keywords such as cinema, football, etc., and displays the API results on the table. The component also has pagination and search capabilities.
![image](https://user-images.githubusercontent.com/79662515/235302605-147f7b2c-0c08-48d8-979b-b8e4a31b23a9.png)
![image](https://user-images.githubusercontent.com/79662515/235302646-a1e1bcfe-4292-4370-8586-939e4f514b4e.png)

## Ticketmaster API
The Ticketmaster API provides access to event data, including event details, venues, and performers. The API is used to receive events with search keywords and display the results on the table component. Here are the relevant endpoints of the Ticketmaster API:

Search API: https://developer.ticketmaster.com/products-and-docs/apis/discovery-api/v2/#search-events-v2
Event Detail API: https://developer.ticketmaster.com/products-and-docs/apis/discovery-api/v2/#event-details-v2
## Project Requirements
The project requirements include:

Build the table component from scratch.
Implement search capabilities in the component.
Add pagination to the component.
Create an event detail page with event details.
Add a show detail button or icon to the table component for routing to the event detail page.
Use bootstrap or another CSS framework.
Use Axios or any other alternatives for HTTP requests.
Tools and Technologies
The following tools and technologies were used in this project:
VueJS
Axios
Bootstrap

## Getting Started
To get started with the project, follow the steps below:

## Clone the repository
Install dependencies using npm install
Create a .env file at the root of the project and add the Ticketmaster API key:
```
REACT_APP_TICKETMASTER_API_KEY=<your_ticketmaster_api_key>
```

Start the application using npm start
Open http://localhost:3000 in your browser

## Building the Table Component
The table component is built from scratch without using any existing library component. It includes the following features:

Search capabilities
Pagination
Sorting (optional)
The component is divided into smaller components for better organization and reusability. The table component receives events from the Ticketmaster API with search keywords and displays them on the table. The component also has pagination and search capabilities.

## Creating the Event Detail Page
The event detail page is created to show the details of a selected event. The page includes the event title, price, place, and other relevant information. The show detail button or icon on the table component is used to navigate to the event detail page.

## Conclusion
This project demonstrates how to build a basic table component with search, pagination, and sort features using ReactJS. The component is built from scratch without using any existing library component. The project also includes an event detail page for displaying the details of a selected event. Tests are written to ensure that the code functions as expected.
