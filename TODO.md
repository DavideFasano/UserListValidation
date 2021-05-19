
  # Validazione TASK-1
  - [ ] completare la validazione del **User**
      - [ ] lastName
      - [ ] email 
      - [ ] valore predefinito per la data   
  
  # Model TASK-2
  - [ ] Finire il Model
    - a.[x] **UserModel::readAll()** (elenco di tutti gli utenti)

  > FIX: argomenti di User nel costruttore
  > too few arguments to function sarassoroberto\usm\entity\User::__construct(), 0 passed and exactly 4 expected 
  > UserModel.php on line 49
  > TO FIXED SEE: https://phpdelusions.net/pdo/objects#parameters

    $result = $stm->fetchAll(PDO::FETCH_CLASS,User::class); // UserFactory
      NOTA: 
    - [x] **User::delete($user_id)** (cancellazione di un utente)

  > NOTE: Come faccio a sapere se ho veramente cancellato qualcosa ?
  > https://www.php.net/manual/en/pdostatement.rowcount.php

    - [x] **UserModel::readOne($user_id)** (dati di un solo utente) 
  
  > FIX: argomenti di User nel costruttore (vedi sopra)
  
    - [ ] **User::update(User $user)** update (modifica)

 # Pagina con elenco utenti TASK-3
  PAGINE (controller)
  - a.[x] Elenco degli utenti **list_user.php**
  
  
  
  
  --------------------------------------------------
  
  qualcuno a premuto aggiungi
     - [ ] creo un istanza User
     - [ ] Effettuo la validazione è sanificazione dei valori dell'istanza di User
     - [ ] se tutto è ok salvo l'utente --> si va a una pagina di conferma
                 [ ] Istanza del model uso il metodo create 
     - [ ] se non è tutto ok rimango sul form e segnalo gli errori

     per ogni errore / campo
     *firstName "Mario" *lastName vuoto
     rimango nel form
     *firstName "MArio" *lasName 
      Risultato della validazione
                           - messaggio "campo obbligatorio"
      isValid = true       - isValid = false 
                           - code
      valore 
      ''
      "Mario"              - ''




- Aggiungere la password
  - [x] aggiungere attributo password nel database 
  - [x] aggiungere campo password nel form
  - [x] aggiungere propietà password nella classe User

- Impostare una chiave unica sulla mail (non ci possono essere due utenti con la stessa mail)
- Quando crei un nuovo utente di crypta la password


- [ ] Implementare la schermata di logIn
  - [x] **login_user.php** controller
  - [x] form dove inserisco email e password
  - [ ] aggiungere **UserModel::autenticate($username,$password):?User**     submit, dati via post 
  - [ ] se l'utente esiste accedo all'elenco degli utenti