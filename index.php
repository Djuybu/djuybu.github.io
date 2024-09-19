<?php
    $hostname = "localhost";
    $username = "root";
    $password = "djuybud3ptr4i";
    $flag = true;
    $db = new mysqli($hostname, $username, $password);

    if ($db->connect_error) {
        die("Connection failed: " .$db->connect_error);
        $flag = false;
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if ($db->query("USE hoctruong") === TRUE) {
            // Execute the query
            $query = $db->query("SELECT * FROM transactions");
        
            $response = array();
        
            if ($query && $query->num_rows > 0) {
                // Fetch and display data
                while ($row = $query->fetch_assoc()) {
                    // Thêm từng đối tượng JSON con vào phản hồi chính
                    $response["transaction_" . $row["id"]] = array(
                        'amount' => $row["amount"],
                        'transactionID' => $row["transaction_id"],
                        'note' => $row["transaction_note"]
                    );
                }
                // Encode the response array to JSON
                echo json_encode($response, JSON_PRETTY_PRINT);
            } else {
                echo json_encode(array("message" => "No results found or query failed."));
            }
        } else {
            echo json_encode(array("message" => "Failed to select database."));
        }
            
    }
?>