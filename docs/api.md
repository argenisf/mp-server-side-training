# Server API endpoints

The MP Tasks server component offers a series of API endpoints to interact with users and tasks.

## Users

Any task interactions requires a user. There is demo user (id: 1) which will not accept updates or any kind to the user or tasks.

---

#### Authenticate a User
**Endpoint**: *server_url*/api/auth_user.php?

**Parameters:**
  * **email (required)**: `String` email address for the user. If the email is associated with an existing user, the user will be logged in. If a user with said email is not found, the user will be created.

**Sample Request:**
[http://server_url/api/auth_user.php?email=demo@mixpanel.com](api?id=authenticate-a-user)

**Return values:** 
  * **JSON Object**: `String` an object containing the result of the operation. It will have the following parameters:
    * **status**: `Boolean` whether the authentication operation succeeded.
    * **error**: `String` error message when the operation fails.
    * **message**: `String` optional additional message when the operation succeeds.
    * **user**: `JSON Object` user details:
      * **id**: `int` database user ID.
      * **email**: `String` user's email.

  * **Sample Response:**
  ```json
	{
		"status":true,
		"error":"",
		"message":"Authenticated with demo account",
		"user":{
			"id":1,
			"email":"demo@mixpanel.com"
		}
	}
  ```

---

## Tasks

Endpoinst to CRUD (Create, Read, Update and Delete) tasks.

---

#### List tasks
Will list available tasks for a given user. Will return pending tasks, as well as tasks completed in the last 24 hours.

**Endpoint**: *server_url*/api/get_tasks.php?

**Parameters:**
  * **user_id (required)**: `int` database ID for the user fetching the tasks for. 

**Sample Request:**
[http://server_url/api/get_tasks.php?user_id=1](api?id=list-tasks)

**Return values:** 
  * **JSON Object**: `String` an object containing the result of the request:
    * **status**: `Boolean` whether the lookup was valid.
    * **error**: `String` error message when the operation fails.
    * **tasks**: `JSON Array` array ob JSON objects with the following key/values:
      * **id**: `int` database task ID.
      * **completed**: `Boolean` whether the task has been marked as completed.
      * **text**: `String` task's text.

  * **Sample Response:**
  ```json
	{
		"status":true,
		"error":"",
		"message":"Authenticated with demo account",
		"tasks":[
			{
				"id":1,
				"text":"delectus aut autem",
				"completed":false
			},
			{...}
		]
	}
  ```

---

#### Create a task
Endpoint to create a new task for a users. Will be created in a pending state.

**Endpoint**: *server_url*/api/create_task.php?

**Parameters:**
  * **user_id (required)**: `int` database ID for the user.
  * **text (required)**: `String` new task's text. 

**Sample Request:**
[http://server_url/api/update_task.php?user_id=1&text=sample%20text](api?id=create-a-task)

**Return values:** 
  * **JSON Object**: `String` an object containing the result of the request:
    * **status**: `Boolean` whether the operation was successful.
    * **error**: `String` error message when the operation fails.
    * **message**: `String` optional additional message when the operation succeeds.
    * **task**: `JSON Object` single object with the task's details:
      * **id**: `int` database task ID.
      * **completed**: `Boolean` will always be returned as `false`.
      * **text**: `String` new task's text.

  * **Sample Response:**
  ```json
	{
		"status":true,
		"error":"",
		"message":"Authenticated with demo account",
		"task":{
			"id":1,
			"completed":false,
			"text":"delectus aut autem"
		}
	}
  ```

---

#### Update a task
Update the state of an existing task from completed to pending or pending to completed. A task can not be updated to the same current state.

**Endpoint**: *server_url*/api/update_task.php?

**Parameters:**
  * **user_id (required)**: `int` database ID for the user.
  * **task_id (required)**: `int` database ID for the task.
  * **completed (required)**: `String` "true" or "false" values  as strings.

**Sample Request:**
[http://server_url/api/update_task.php?user_id=1&task_id=1&completed=true](api?id=update-a-task)

**Return values:** 
  * **JSON Object**: `String` an object containing the result of the request:
    * **status**: `Boolean` whether the operation was successful.
    * **error**: `String` error message when the operation fails.
    * **message**: `String` optional additional message when the operation succeeds.
    * **task**: `JSON Object` single object with the task's new state:
      * **id**: `int` database task ID.
      * **completed**: `Boolean` new state of the task true/false.
      * **text**: `String` task's text. Will be returned if provided.

  * **Sample Response:**
  ```json
	{
		"status":true,
		"error":"",
		"message":"Authenticated with demo account",
		"task":{
			"id":1,
			"completed":false,
			"text":"delectus aut autem"
		}
	}
  ```

---

#### Delete a task
Delete an existing task.

**Endpoint**: *server_url*/api/update_task.php?

**Parameters:**
  * **user_id (required)**: `int` database ID for the user.
  * **task_id (required)**: `int` database ID for the task.

**Sample Request:**
[http://server_url/api/delete_task.php?user_id=1&task_id=1](api?id=delete-a-task)

**Return values:** 
  * **JSON Object**: `String` an object containing the result of the request:
    * **status**: `Boolean` whether the operation was successful.
    * **error**: `String` error message when the operation fails.
    * **message**: `String` optional additional message when the operation succeeds.
    * **task**: `JSON Object` single object from the deleted task:
      * **id**: `int` database task ID (now deleted).

  * **Sample Response:**
  ```json
	{
		"status":true,
		"error":"",
		"message":"Change not permanent. Using demo account",
		"task":{
			"id":1
		}
	}
  ```

