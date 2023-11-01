
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
</style>
</head>
<body>

<h2>Booking Details from Tutor</h2>

<div style="overflow-x:auto;">
  <table>
    <tr>
      <th>Booking ID</th>
      <th>Teacher Name</th>
      <th>Subject</th>
      <th>Day</th>
      <th>Duration</th>
      <th>Date of Booking</th>
    </tr>
    <tr>
      <td>{{$booking_id}}</td>
      <td>{{$teacher_name}}</td>
      <td>{{$subject}}</td>
      <td>{{$day}}</td>
      <td>{{$duration}}</td>
      <td>{{$date}}</td>
    </tr>
 
   
  </table>
</div>

</body>
</html>
