import subprocess
import include.library.phpy as phpy
subprocess.call('ping '+phpy.get_data(1))
print("that's work")