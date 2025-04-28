using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class ObstaclePrefab2 : MonoBehaviour
{
    public float speed = 2f;
    public GameObject player;

    void Update()
    {
        transform.Translate(Vector2.down * speed * Time.deltaTime);
        //檢查是否離開畫面
        if (transform.position.y < -10f)
        {
            Destroy(gameObject);
        }
    }
}
