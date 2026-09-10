import json

transcript_path = r'C:\Users\Asus\.gemini\antigravity-ide\brain\3c094e1f-41de-4e5e-bff1-14f1432bbde1\.system_generated\logs\transcript_full.jsonl'
found = False

with open(transcript_path, 'r', encoding='utf-8') as f:
    lines = f.readlines()

for line in reversed(lines):
    data = json.loads(line)
    if data.get('type') == 'TOOL_RESPONSE':
        content = data.get('content', '')
        if 'c:\\xampp\\htdocs\\pelayanan psdkp\\public\\css\\app.css' in content and 'multi_replace_file_content' in content:
            with open('recovered_diff.txt', 'w', encoding='utf-8') as out:
                out.write(content)
            print('Recovered diff to recovered_diff.txt')
            found = True
            break
if not found:
    print('Not found')
