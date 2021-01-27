import include.library.phpy as phpy
import time
import playsound
import speech_recognition as sr
from gtts import gTTS
import pyaudio
# functions


def speack(text):
    tts = gTTS(text=text, lang="en")
    filename = "../Test/music/voice.mp3"
    tts.save(filename)
    playsound.playsound(filename)


def get_audio():
    r = sr.Recognizer()
    with sr.Microphone() as source:
        audio = r.listen(source)
        said = ""
        try:
            said = r.recognize_google(audio)
            print(said)
        except Exception as e:
            print("Exception : "+str(e))
    return said


if __name__ == "__main__":
    # Run
    text = get_audio()
    if "hello" in text:
        speack('hello how are you?')
        print('hello how are you?')
        time.sleep(1)
    if "what is your name" in text:
        speack('My name is '+phpy.get_data(1))
        print('My name is '+phpy.get_data(1))
        time.sleep(1)
