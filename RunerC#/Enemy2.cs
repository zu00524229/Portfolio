using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class Enemy2 : MonoBehaviour
{
    public GameObject obstacle;         // 障礙物預設物件
    public Transform T1point;           // 第一生成點
    public Transform T2point;           // 第二生成點
    public Transform T3point;           // 第三生成點
    public Transform T4point;           // 第四生成點
    public float spawnInterval = 2f;    // 障礙物生成間隔
    public float activationDelay = 30f; // 延遲啟動時間
    public AudioSource woodAudioSource; // 木頭音效來源



    void Start()
    {
        this.gameObject.SetActive(false); // 初始設為禁用
        Invoke("ActivateSpawner", activationDelay); // 延遲啟動障礙物生成
    }

    // 方法名稱修正為正確拼寫
    private void ActivateSpawner()
    {
        this.gameObject.SetActive(true); // 啟動該物件
        InvokeRepeating("obstacles", 0f, spawnInterval); // 開始固定時間間隔生成
    }

    void obstacles()
    {
        // 定義生成點的陣列
        Transform[] spawnPoints = new Transform[] { T1point, T2point, T3point, T4point };

        // 隨機選擇兩個不同的生成點
        List<int> selectedIndices = new List<int>();
        while (selectedIndices.Count < 2)
        {
            int randomIndex = Random.Range(0, spawnPoints.Length);
            if (!selectedIndices.Contains(randomIndex))
            {
                selectedIndices.Add(randomIndex);
            }
        }

        foreach (int index in selectedIndices)
        {
            Transform spawnPoint = spawnPoints[index];

            // 確保生成點有效
            if (spawnPoint == null)
            {
                Debug.LogError($"生成點為 null（索引：{index}），請檢查設置！");
                continue;
            }

            // 在選定的位置生成障礙物
            GameObject newObstacle = Instantiate(obstacle, spawnPoint.position, spawnPoint.rotation);

            // 播放木頭生成音效
            if (woodAudioSource != null && !woodAudioSource.isPlaying)
            {
                woodAudioSource.Play();
            }
            // 為新生成的障礙物添加移動功能
            ObstacleMovement obstacleMoveScript = newObstacle.GetComponent<ObstacleMovement>();
            if (obstacleMoveScript != null)
            {
                GameObject player = GameObject.FindGameObjectWithTag("Player");
                if (player != null)
                {
                    obstacleMoveScript.player = player; // 設置玩家物件
                }
                else
                {
                    Debug.LogWarning("玩家物件未找到，請確認場景中是否存在帶有 'Player' 標籤的物件！");
                }
            }
        }
    }

}
