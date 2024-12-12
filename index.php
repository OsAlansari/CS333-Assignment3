<!--Done by
Osama Anwar Alansari      202103778
Mohammed Hussain Haouas   20194952-->
<?php
// // Group data by year and semester
// $groupedData = [];
// foreach ($result['results'] as $rs) {
//     $groupedData[$rs['year']][$rs['semester']][] = $rs;
// }
// // Function to sort rows by nationality
// function sortByNationality($a, $b) {
//     $order = ['Bahraini', 'GCC National', 'Other'];
//     $posA = array_search($a['nationality'], $order);
//     $posB = array_search($b['nationality'], $order);
//     return $posA - $posB;
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UOB Data API</title>
    <!--- Add styling --->
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@latest/css/pico.min.css">
    <link rel="stylesheet" href="style.css">
    <!--- Add script --->
    <script defer src="script.js"></script>
</head>
<body>
    <h1>Number of students enrolled in bachelor programs in college of IT, UoB</h1>
    <div class = "overflow-auto">    
    <!--- Display the data in a table --->
    <table>
        <thead data-theme = "dark">
            <tr>
                <th>Year</th>
                <th>Semester</th>
                <th>Nationality</th>
                <th>Number of students</th>
            </tr>
        </thead>
        <tbody id="APIData">
        </tbody>
    </table>
    </div>
</body>
</html>
