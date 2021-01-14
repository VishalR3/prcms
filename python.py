import requests

r = requests.get('http://localhost/attendance/api/getEmployees/')

print(r.status_code)
print(r.headers['content-type'])

employees = r.json()
for employee in employees:
    print(employee['name'])

payload = {
    'empID': employees[1]['empID']
}

post = requests.post(
    'http://localhost/attendance/api/postEmployeeAttendance', data=payload)

print(post.status_code)
print(post.text)
