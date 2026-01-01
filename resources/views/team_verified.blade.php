<!DOCTYPE html>
<html>

<head>
    <title>ID Verified</title>
</head>

<body>
    <h2>Congratulations {{ $team->name }} 🎉</h2>

    <p>Your Payment has been successfully verified.</p>

    <p>
        <strong>Team ID:</strong> {{ $team->team_id }}
    </p>

    <p>
        Please find your <strong>e-pass attached</strong>.
        Bring this e-pass on the event day.
    </p>

    <br>
    <p>Best Regards,<br>
        <strong>Coding Club Team</strong>
    </p>
</body>

</html>