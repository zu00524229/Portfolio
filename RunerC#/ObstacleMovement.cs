using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class ObstacleMovement : MonoBehaviour
{
    public float speed = 5f;   // 障礙物移動速度
    public GameObject player;  // 玩家物件
    private Animator animator;     // 動畫控制器
    private bool isDying = false;  // 標記障礙物是否在播放死亡動畫


    void Start()
    {
        animator = GetComponent<Animator>(); // 獲取動畫控制器

    }

    void Update()
    {
        if (!isDying) // 如果沒有在播放死亡動畫
        {
            // 向左移動
            transform.Translate(Vector2.left * speed * Time.deltaTime);

            // 檢查障礙物是否離開畫面，若離開則銷毀
            if (transform.position.x < -10f) // 可以根據需要調整場景邊界
            {
                Destroy(gameObject);
            }
        }
    }

}