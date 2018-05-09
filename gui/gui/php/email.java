final String username = "<mail_name>";
final String password = "<password>";

Properties props = new Properties();
props.put("mail.smtp.auth", "true");
props.put("mail.smtp.starttls.enable", "true");
props.put("mail.smtp.host", "smtp.gmail.com");
props.put("mail.smtp.port", "465");

Session session = Session.getInstance(props,
        new javax.mail.Authenticator() {
            protected PasswordAuthentication getPasswordAuthentication() {
                return new PasswordAuthentication(username, password);
            }
        });

try {

    Message message = new MimeMessage(session);
    message.setFrom(new InternetAddress("<mail_from>@gmail.com"));
    message.setRecipients(Message.RecipientType.TO,
            InternetAddress.parse("<mail_to>@gmail.com"));
    message.setSubject("Test Subject");
    message.setText("Test");

    Transport.send(message);

    System.out.println("Done");

} catch (MessagingException e) {
    throw new RuntimeException(e);
}