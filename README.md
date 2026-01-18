# MyPub
Test-bed to learn ActivityPub from documentation and implement a federated user.

## To-Do list
- [X] User model should have a username, a public_key and private_key field (plus Laravel defaults)
- [X] Make sure private_key is encrypted using Laravel encrypted casting
- [X] Use `openssl_pkey_new` to generate the key pair using the created Event
- [X] Create a seeder for the user to start testing
- [X] Create a stub ActorController
  - [X] /u/{username} - Actor endpoint
- [ ] Create a /.well-known/webfinger enpoint that returns the user's ActivityPub profile URL
  - [ ] Create WebfingerController
  - [ ] Parse the query parameter 'resource'
  - [ ] Return standard JRD JSON linking to the Actor's endpoint
- [ ] Implement the Actor endpoint
- [ ] Implement a basic inbox endpoint
  - [ ] /u/{username}/inbox - Inbox endpoint
  - [ ] Verify the signature of incoming requests
  - [ ] Log incoming activities
- [ ] Parse the incoming activities
  - [ ] Use a JSON-LD parser (digitalbazaar/php-json-ld) to expand the json ld activity 
  - [ ] Map incoming activities to internal classes
- [ ] Implement a basic outbox endpoint
  - [ ] /u/{username}/outbox - Outbox endpoint
- [ ] Handle follow activity
  - [ ] Recieve a follow activity
  - [ ] Add the follower to the followers list
  - [ ] Send a follow accept activity to the follower
