import json

transcript_path = r'C:\Users\Asus\.gemini\antigravity-ide\brain\3c094e1f-41de-4e5e-bff1-14f1432bbde1\.system_generated\logs\transcript_full.jsonl'

with open(transcript_path, 'r', encoding='utf-8') as f:
    lines = f.readlines()

for line in reversed(lines):
    data = json.loads(line)
    # Check if this step made a call to multi_replace_file_content
    tool_calls = data.get('tool_calls', [])
    if any(tc.get('name') == 'default_api:multi_replace_file_content' for tc in tool_calls):
        for tc in tool_calls:
            if tc.get('name') == 'default_api:multi_replace_file_content':
                print(json.dumps(tc['args'], indent=2))
                with open('recovered_args.json', 'w', encoding='utf-8') as out:
                    out.write(json.dumps(tc['args'], indent=2))
                break
        break
