using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class Floor : MonoBehaviour
{
    [SerializeField] float moveSpeed = 2f;  // 地板移動的速度，單位為每秒（f 是 float 類型）

    void Start()
    {
        // 在這個範例中，Start() 方法目前沒有實現任何內容
    }

    void Update()
    {
        // 每一幀移動地板，Y 軸方向的移動速度由 moveSpeed 控制
        // Time.deltaTime 會確保每一幀的移動速度是穩定的，不會因為不同的幀數而變化
        transform.Translate(0, moveSpeed * Time.deltaTime, 0);

        // 如果地板移動到超過 y = 6 的位置，就銷毀這個地板物件
        if (transform.position.y > 6f)
        {
            Destroy(gameObject);  // 銷毀當前的地板物件
            // 呼叫父物件（假設是 FloorManager）的 SpawnFloor 方法來生成新的地板
            transform.parent.GetComponent<FloorManger>().SpawnFloor();
        }
    }
}
