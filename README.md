
# New Meeting finder

This is the simple API from find fast and better way to get available meeting slots.


## Environment Variables

To run this project, you will need to add the following environment variables to your .env file

`OPEN_HOURS="08:00-17:00"`


## Installation

Install this project

```bash
  composer Install
```
    
## API Reference

#### Store text file data

```http
  POST /api/file-upload
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `file` | `file` | **Required**. file with meeting data |

#### Get available slots

```http
  POST /api/available-slots
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `emp_id`      | `string` | **Required**. Id of employee to fetch |
| `schedule_from`| `string` | **Required**. Meeting schedule start date time|
| `schedule_to`| `string` | **Required**. Meeting schedule end date time|
| `schedule_to`| `string` | **Required**. Meeting schedule end date time|
| `meeting_duration`| `string` | **Required**. Meeting duration eg: 01:00|
| `meeting_slot`| `string` | **Required**. Meeting slot eg: 01:00|

#### Postman collection

Use this collection json file

`limeTest.postman_collection.json`



## Running Tests

To run tests, run the following command

```bash
  php artisan test
```

