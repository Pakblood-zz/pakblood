<div>

    Dear Admin <br><br><br>


    A New User Registered.<br><br>


    <table>
        <tr>
            <td>Name :</td>
            <td>{{ $name }}</td>
        </tr>
        <tr>
            <td>Username :</td>
            <td> {{ $username }} </td>
        <tr>
            <td>Email :</td>
            <td> {{ $email }} </td>
        <tr>
            <td>Gender :</td>
            <td> {{ ($gender == 'm')?"Male":"Female" }} </td>
        <tr>
            <td>Date Of Birth :</td>
            <td>{{ $dob }} </td>
        <tr>
            <td>Phone :</td>
            <td> {{ $phone }} </td>
        <tr>
            <td>Mobile :</td>
            <td> {{ $mobile }} </td>
        <tr>
            <td>Address :</td>
            <td> {{ $address }} </td>
        <tr>
            <td>City :</td>
            <td> {{ $city }} </td>
        <tr>
            <td>Blood Group :</td>
            <td>{{ $blood_group }} </td>
        <tr>
            <td>Status :</td>
            <td> {{ $status }} </td>
    </table>

    @include ('emails.__footer')

</div>
