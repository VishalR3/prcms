import requests

r = requests.get('http://localhost/attendance/api/getEmployees/')

print(r.status_code)
print(r.headers['content-type'])

employees = r.json()
for employee in employees:
    print(employee['name'])

payload = {
    'empID': employees[0]['empID']
}

post = requests.post(
    'http://localhost/attendance/api/postEmployeeAttendance', data=payload)

print(post.status_code)
print(post.text)

post2 = requests.post(
    'http://localhost/attendance/api/postVisitorAttendance')

print(post2.status_code)
print(post2.text)
