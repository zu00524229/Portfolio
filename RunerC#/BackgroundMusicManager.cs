using UnityEngine;

public class BackgroundMusicManager : MonoBehaviour
{
    public AudioSource backgroundMusic;  // 音樂播放器

    void Start()
    {
        if (backgroundMusic != null)
        {
            backgroundMusic.Play();  // 開始播放背景音樂
        }
    }


    // 停止背景音樂
    public void StopMusic()
    {
        if (backgroundMusic != null)
        {
            backgroundMusic.Stop();  // 停止音樂
        }
    }

    // 暫停背景音樂
    public void PauseMusic()
    {
        if (backgroundMusic != null)
        {
            backgroundMusic.Pause();  // 暫停音樂
        }
    }
}
