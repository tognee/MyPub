# MyPub
Test-bed to learn ActivityPub from documentation and implement a federated user.

## To-Do list
- [X] User model should have a username, a public_key and private_key field (plus Laravel defaults)
- [X] Make sure private_key is encrypted using Laravel encrypted casting
- [X] Use `openssl_pkey_new` to generate the key pair using the created Event
- [X] Create a seeder for the user to start testing
- [X] Create a stub ActorController
  - [X] /u/{username} - Actor endpoint
- [X] Create a /.well-known/webfinger enpoint that returns the user's ActivityPub profile URL
  - [X] Create WebfingerController
  - [X] Parse the query parameter 'resource'
  - [X] Return standard JRD JSON linking to the Actor's endpoint
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

## Notes
There is a good thing to understand first: the difference between ActivityVocabulary, AcrivityStreams, ActivityPub, and something like Mastodon.
- [ActivityVocabulary](https://www.w3.org/TR/activitystreams-vocabulary/): Defines the base properties and types
- [AcrivityStreams](https://www.w3.org/ns/activitystreams): Defines the schema used by ActivityPub, it has the base ActiviryVocabulary types and properties + extensions for ActivityPub and DID Core
- [ActivityPub](https://www.w3.org/TR/activitypub/): Uses ActivityStreams and defines the protocol used for S2S comunication, and a draft of a C2S API.
- Mastodon: Uses ActivityPub + it's out C2S API.

The ActivityPub spec doesn't tell you what you should do with the data you get, how to save it, where to store it, how to serve it. It just tells you how to share it with other servers. It doesn't impose a Framework to work on.
On the other hand Mastodon is the most famous app that uses the protocol, and all the other devs are building mastodontic software (pun intended) by copying what Mastodon does. This way we have Client and servers mashed together, no separation of concern and a more opinionated platform that is not explicitly given by the documentation.

My goal with this project it to understand how ActivityPub works, and how to implement it in a way that isn't the Mastodon way, by explicitly not following how things are done over there.
That being said here are my other notes, that I will keep writing during the development of this project.

---

I'm pretty sure storing the private key in the database is not a good idea, but for now it will work.
The fact that it's at least encrypted is a good start.

---

The webfinger doesn't know anything other than the users I add to this db. Having an external webfinger could offload the webfinger management and let it be used for other things (for example getting informations for URLs).  
Webfinger is not in the specification, but it's the de-facto standard for discovering ActivityPub actors.

---

Why is no one implementing JSON-LD right? Every project I've looked at doesn't parse the schemas, and take for granted that everything that comes to it's way is a valid JSON-LD schema with the as context. What If i call the as context with another way? What if I send the json with the expanded keys? I don't get it. Is it too hard?

---

The only property I've encountered in Activity Vocabulary that doesn't make much sense and it isn't explained anywhere in the docs is `closed`. It can be:
- boolean: tells you if it's closed or not closed yet.
- datetime: tells you when it has been closed.
- Object or Link: sends you to why it has been closed.

I think that a `closedAt` for the datetime, and a `closedBy` for the reason with an object or a link would have been better.
