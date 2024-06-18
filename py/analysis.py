import mysql.connector
import matplotlib.pyplot as plt
import pandas as pd
import seaborn as sns

connection = mysql.connector.connect(
    host='localhost',
    user='root',
    password='',
    database='fyproject'
)

cursor = connection.cursor()

query = "SELECT skill FROM jobs"
cursor.execute(query)

results = cursor.fetchall()

total = []
for i in results:
    total.append(i[0])

skills = map(lambda x: x.split(","), total)
total = []
for skill_list in skills:
    total.extend(skill_list)
total = [skill.lower() for skill in total]

total_df = pd.DataFrame(total, columns=['total'])

top_values = total_df['total'].value_counts().nlargest(5)

plt.figure(figsize=(12, 8))
sns.set(style="whitegrid")

barplot = sns.barplot(x=top_values.index, y=top_values.values, palette="viridis", edgecolor='black')

plt.title('Top 5 Skills Distribution', fontsize=20, weight='bold', pad=20)
plt.xlabel('JOBS', fontsize=15, weight='bold', labelpad=15)
plt.ylabel('Count', fontsize=15, weight='bold', labelpad=15)

plt.xticks(rotation=45, fontsize=12, weight='bold')
plt.yticks(fontsize=12, weight='bold')

sns.despine(top=True, right=True)

plt.tight_layout()
plt.savefig('./images/plot1.png')


query = "SELECT skills FROM skills"
cursor.execute(query)

results = cursor.fetchall()

total = []
for i in results:
    total.append(i[0])

skills = map(lambda x: x.split(","), total)
total = []
for skill_list in skills:
    total.extend(skill_list)
total = [skill.lower() for skill in total]

total_df = pd.DataFrame(total, columns=['total'])

top_values = total_df['total'].value_counts().nlargest(5)
for i in results:
    total.append(i[0])
barplot = sns.barplot(x=top_values.index, y=top_values.values, palette="viridis", edgecolor='black')

plt.title('Top 5 Skills Distribution', fontsize=20, weight='bold', pad=20)
plt.xlabel('Skills', fontsize=15, weight='bold', labelpad=15)
plt.ylabel('Count', fontsize=15, weight='bold', labelpad=15)

plt.xticks(rotation=45, fontsize=12, weight='bold')
plt.yticks(fontsize=12, weight='bold')

sns.despine(top=True, right=True)

plt.tight_layout()
plt.savefig('./images/plot2.png')


query = "SELECT skill FROM needs"
cursor.execute(query)

results = cursor.fetchall()

total = []
for i in results:
    total.append(i[0])

skills = map(lambda x: x.split(","), total)
total = []
for skill_list in skills:
    total.extend(skill_list)
total = [skill.lower() for skill in total]

total_df = pd.DataFrame(total, columns=['total'])

top_values = total_df['total'].value_counts().nlargest(5)
for i in results:
    total.append(i[0])
barplot = sns.barplot(x=top_values.index, y=top_values.values, palette="viridis", edgecolor='black')

plt.title('Top 5 Skills Distribution', fontsize=20, weight='bold', pad=20)
plt.xlabel('needs', fontsize=15, weight='bold', labelpad=15)
plt.ylabel('Count', fontsize=15, weight='bold', labelpad=15)

plt.xticks(rotation=45, fontsize=12, weight='bold')
plt.yticks(fontsize=12, weight='bold')

sns.despine(top=True, right=True)

plt.tight_layout()
plt.savefig('./images/plot3.png')



query = "SELECT searchtype FROM explore"
cursor.execute(query)

results = cursor.fetchall()

total = []
for i in results:
    total.append(i[0])

skills = map(lambda x: x.split(","), total)
total = []
for skill_list in skills:
    total.extend(skill_list)
total = [skill.lower() for skill in total]

total_df = pd.DataFrame(total, columns=['total'])

top_values = total_df['total'].value_counts().nlargest(5)
for i in results:
    total.append(i[0])
barplot = sns.barplot(x=top_values.index, y=top_values.values, palette="viridis", edgecolor='black')

plt.title('Top 5 Fileds', fontsize=20, weight='bold', pad=20)
plt.xlabel('needs', fontsize=15, weight='bold', labelpad=15)
plt.ylabel('Count', fontsize=15, weight='bold', labelpad=15)

plt.xticks(rotation=45, fontsize=12, weight='bold')
plt.yticks(fontsize=12, weight='bold')

sns.despine(top=True, right=True)

plt.tight_layout()
plt.savefig('./images/plot4.png')


query = "SELECT salary FROM jobs"
cursor.execute(query)

# Fetch all results
results = cursor.fetchall()

# Process the results
salaries = [row[0] for row in results if row[0] is not None]  # Exclude None values if any

# Close the cursor and connection


# Plotting the histogram
plt.figure(figsize=(10, 6))
plt.hist(salaries, bins=20, color='skyblue', edgecolor='black')  # Adjust number of bins as needed
plt.title('Salary Distribution', fontsize=20)
plt.xlabel('Salary', fontsize=15)
plt.ylabel('Frequency', fontsize=15)
plt.grid(True)
plt.savefig('./images/plot5.png')

query = "SELECT nature FROM jobs"
cursor.execute(query)

# Fetch all results
results = cursor.fetchall()

# Process the results
natures = [row[0] for row in results if row[0] is not None]  # Exclude None values if any

# Create a DataFrame for easier plotting
nature_df = pd.DataFrame({'Nature': natures})

# Count the occurrences of each nature
nature_counts = nature_df['Nature'].value_counts()

# Plotting the bar plot
plt.figure(figsize=(10, 6))
sns.set(style="whitegrid")

barplot = sns.barplot(x=nature_counts.index, y=nature_counts.values, palette="viridis", edgecolor='black')

plt.title('Job Type', fontsize=20)
plt.xlabel('Nature', fontsize=15)
plt.ylabel('Count', fontsize=15)
plt.xticks(rotation=45, fontsize=12)  # Rotate x-axis labels for better readability
plt.yticks(fontsize=12)
plt.tight_layout()
plt.savefig('./images/plot6.png')

cursor.close()
connection.close()
