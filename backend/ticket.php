<?php
// Ticketmaster API configuration
$api_key = "An2TVsQ4WrKZTwqn7tWHVyBJB9gWv07K";
$keyword = "Matt Rife";
$to = 'paramountsky7@gmail.com';
// $to = 'danmahoney17@gmail.com';
$nowdate = date("Y-m-d");


// MySQL configuration
$host = "localhost";
$username = "root";
$password = "";
$database = "new_ticketmaster";

// $host = "95.211.254.12";
// $username = "fonefuncom";
// $password = "Vh_mW*Nf?fUJ";
// $database = "fonefunc_AMZ";

$table_name = "events";
$field_name = "event_id";

// $table_name = "test";
// $field_name = "eid";

// Connect to MySQL
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Ticketmaster API endpoint for retrieving events
$endpoint = "https://app.ticketmaster.com/discovery/v2/events.json";

// Query parameters for the API request
$params = array(
    "apikey" => $api_key,
    "keyword" => $keyword,
    "sort" => "date,name,desc",
    "size" => 10,
    "onsaleOnAfterStartDate" => $nowdate,
);

$email_contents = "";

// Send API request to Ticketmaster
$url = $endpoint . "?" . http_build_query($params);
$response = file_get_contents($url);
$data = json_decode($response, true);
$total_page = $data['page']['totalPages'];

echo "total pages:" . json_encode($total_page) . "<br/>";
$counts = 1;
for ($i = 0; $i < $total_page; $i++) {
    echo "page number:" . ($i + 1) . "<br/>";
    $updated_cnt = 0;
    $params_page = array(
        "apikey" => $api_key,
        "keyword" => $keyword,
        "page" => $i,
        "size" => 10,
        "sort" => "date,name,desc",
        "onsaleOnAfterStartDate" => $nowdate,
    );

    $url_page = $endpoint . "?" . http_build_query($params_page);
    $response_page = file_get_contents($url_page);
    $data_page = json_decode($response_page, true);

    // Check if API request was successful
    if ($data_page["_embedded"]["events"]) {
        // Retrieve the list of events
        $events = $data_page["_embedded"]["events"];

        // Iterate through the events and check for new ones
        foreach ($events as $event) {
            $event_id = $event["id"];

            // echo($event_id);
            // Check if the event already exists in the database
            $sql = "SELECT * FROM ".$table_name." WHERE ".$field_name." = '$event_id'";
            $result = $conn->query($sql);

            // if ($result->num_rows == 0) {
                // Event is new, insert it into the database
                $sql = "INSERT INTO ".$table_name." (".$field_name.") VALUES ('$event_id')";
                $conn->query($sql);

                echo ($counts++) . ":" . $event_id . "<br/>";
                $updated_cnt++;

                $email_contents .= '
                <div style="font-family: Arial, sans-serif; padding: 20px;">
                    <h3> ' . $event["name"] . '</h3>
                    <p><strong>Id:</strong> ' . $event["id"] . '</p>
                    <p><strong>Genre/Subgenre:</strong> ' . $event['classifications'][0]['genre']['name'] . '/' . $event['classifications'][0]['subGenre']['name'] . '</p>
                    <p><strong>Promoter:</strong> ' . $event['promoter']['name'] . '</p>
                    <p><strong>Venue:</strong> ' . $event["_embedded"]['venues'][0]['name'] . ', ' . $event["_embedded"]['venues'][0]['city']['name'] . ', ' . $event["_embedded"]['venues'][0]['country']['name'] . '</p>
                    <p><strong>Date/Time:</strong> ' . $event['dates']['start']['localDate'] . ' - ' . $event['dates']['start']['localTime'] . '</p>
                    <p><a href="' . $event["url"] . '">On Sale! (' . $event["sales"]['public']['endDateTime'] . ')</a></p>
                    <img style="max-width: 300px; height: auto; margin-top: 20px;" src="' . $event["images"][0]['url'] . '" alt="' . $event["name"] . '">
                </div>
                ';
            // }
        }
    } else {
        // Handle API request error
        echo "Error: " . $data["errors"][0]["detail"];
    }

    if (!$updated_cnt) {
        break;
    }
}
if ($counts > 1) {
    $subject = 'New Events';
    $message = '<!DOCTYPE html>
        <html lang="en">
        <head>
          <title>New Events</title>
        </head>
        <body> 
         
        <div style="background-color: lightgrey; padding: 20px">
          <div style="width: 80%; margin:auto; height: max-content; background-color: white; padding: 30px">
            <h2>Hello, This is new event lists for ' . $keyword . '</h2>
            ' . $email_contents . '
          </div>
        </div>
        
        </body>
        </html>';
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    echo $message . "<br/>";

    // Send the email
    $mailSent = mail($to, $subject, $message, $headers);

    // Check if the email was sent successfully
    if ($mailSent) {
        echo 'Email sent successfully.';
    } else {
        echo 'Error sending email.';
    }
}


// Close the database connection
$conn->close();
