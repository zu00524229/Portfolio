using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class Enemy : MonoBehaviour
{
    public GameObject obstaclePrefab1;  // 第一種障礙物
    public GameObject obstaclePrefab2;  // 第二種障礙物
    public Transform spawnPoint1;       // 第一種障礙物的生成位置
    public Transform spawnPoint2;       // 第二種障礙物的生成位置
    public float spawnInterval1 = 5f;    // 第一種障礙物的生成間隔
    public float spawnInterval2 = 4f;    // 第二種障礙物的生成間隔

    void Start()
    {
        // 開始重複生成兩種障礙物，使用不同的生成間隔
        InvokeRepeating("SpawnObstacle1", 0f, spawnInterval1);  // 第一種障礙物
        InvokeRepeating("SpawnObstacle2", 0f, spawnInterval2);  // 第二種障礙物
    }

    // 生成第一種障礙物的方法
    void SpawnObstacle1()
    {
        if (obstaclePrefab1 != null && spawnPoint1 != null)
        {
            GameObject newObstacle1 = Instantiate(obstaclePrefab1, spawnPoint1.position, Quaternion.identity);
            SetObstacleTarget(newObstacle1);  // 設置玩家作為目標
        }
    }

    // 生成第二種障礙物的方法
    void SpawnObstacle2()
    {
        if (obstaclePrefab2 != null && spawnPoint2 != null)
        {
            GameObject newObstacle2 = Instantiate(obstaclePrefab2, spawnPoint2.position, Quaternion.identity);
            SetObstacleTarget(newObstacle2);  // 設置玩家作為目標
        }
    }

    // 設置障礙物的目標為玩家
    void SetObstacleTarget(GameObject obstacle)
    {
        // 為障礙物添加移動功能並設定目標
        ObstacleMovement obstacleMoveScript = obstacle.GetComponent<ObstacleMovement>();
        if (obstacleMoveScript != null)
        {
            // 找到玩家物件並設置為目標
            GameObject player = GameObject.FindGameObjectWithTag("Player");
            if (player != null)
            {
                obstacleMoveScript.player = player;
            }
            else
            {
                Debug.LogWarning("玩家物件未找到，請確認場景中是否存在帶有 'Player' 標籤的物件！");
            }
        }
    }
}
