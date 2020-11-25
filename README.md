# FUNCTIONNAL TEST WITH MESSENGER AND MAIL

## How to reproduce

### Test transport

´´´yaml
//config/packages/tests/messenger.yaml

framework:
  messenger:
    transports:
      async: "in-memory://"

´´´
uncomment

´´´php
//tests/Controller/AppControllerTest.php line 31-32

    $transport = self::$container->get('messenger.transport.async');
    $this->assertCount(1, $transport->get());
´´´


### Test email send

´´´yaml
//config/packages/tests/messenger.yaml

framework:
  messenger:
    transports:
      async: "sync://"

´´´
uncomment

´´´php
//tests/Controller/AppControllerTest.php line 29

$this->assertEmailCount(1);
´´´
