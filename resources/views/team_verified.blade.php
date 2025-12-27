<!DOCTYPE html>
<html>

<head>
    <title>Team Verified</title>
</head>

<body>
    <h2>Congratulations {{ $team->name }} 🎉</h2>

    <p>Your Clash Royal team has been successfully verified.</p>

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