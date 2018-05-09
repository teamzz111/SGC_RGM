#include <CkMailMan.h>
#include <CkEmail.h>

void ChilkatSample(void)
    {
    CkMailMan mailman;

    mailman.put_SmtpHost("smtp.chilkatsoft.com");
    mailman.put_SmtpUsername("myUsername");
    mailman.put_SmtpPassword("myPassword");

    CkEmail email;

    email.put_Subject("This is a test");
    email.put_Body("This is a test");
    email.put_From("Chilkat Support <support@chilkatsoft.com>");
    success = email.AddTo("Chilkat Admin","admin@chilkatsoft.com");

    success = mailman.SendEmail(email);
    if (success != true) {
        std::cout << mailman.lastErrorText() << "\r\n";
        return;
    }

    success = mailman.CloseSmtpConnection();
    if (success != true) {
        std::cout << "Connection to SMTP server not closed cleanly." << "\r\n";
    }
    std::cout << "Mail Sent!" << "\r\n";
    }