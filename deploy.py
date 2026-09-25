import paramiko

def run_ssh_cmd(cmd):
    client = paramiko.SSHClient()
    client.set_missing_host_key_policy(paramiko.AutoAddPolicy())
    try:
        client.connect('156.67.222.63', port=65002, username='u460671493', password='pangkalanbitung/QS3CCd~5V', timeout=15)
        print(f"Executing: {cmd}")
        stdin, stdout, stderr = client.exec_command(cmd, timeout=30)
        out = stdout.read().decode()
        err = stderr.read().decode()
        print("STDOUT:\n", out)
        if err:
            print("STDERR:\n", err)
    except Exception as e:
        print("SSH Error:", e)
    finally:
        client.close()

if __name__ == "__main__":
    run_ssh_cmd("cd domains/psdkppelayanan.sipelintas.com/public_html && git pull origin main")
