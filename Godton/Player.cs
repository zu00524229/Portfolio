using System.Collections;
using System.Collections.Generic;
using Unity.VisualScripting;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.SceneManagement;

public class Player : MonoBehaviour
{
    // 玩家移動速度
    [SerializeField] float moveSpeed = 5f;

    // 當前站立的階梯
    GameObject currentFloor;

    // 玩家血量
    [SerializeField] int Hp;

    // 血量顯示UI
    [SerializeField] GameObject HpBar;

    // 分數顯示的文字
    [SerializeField] Text scoreText;

    // 玩家分數與計時變數
    int score;
    float scoreTime;

    // 動畫控制器與圖層渲染
    Animator anim;
    SpriteRenderer render;

    // 死亡音效
    AudioSource deathSound;

    // 重玩按鈕
    [SerializeField] GameObject replayButton;
    private object rb2d;

    // 初始化
    void Start()
    {
        Hp = 10; // 初始血量為10
        score = 0; // 初始分數為0
        scoreTime = 0f; // 分數計時初始化
        anim = GetComponent<Animator>(); // 獲取動畫控制器
        render = GetComponent<SpriteRenderer>(); // 獲取圖層渲染器
        deathSound = GetComponent<AudioSource>(); // 獲取音效組件
    }

    // 每一幀更新
    void Update()
    {
        // 玩家按鍵控制 (右移)
        if (Input.GetKey(KeyCode.D))
        {
            transform.Translate(moveSpeed * Time.deltaTime, 0, 0); // 角色向右移動
            render.flipX = false; // 取消圖像水平翻轉
            anim.SetBool("run", true); // 設定動畫為跑步
        }
        // 玩家按鍵控制 (左移)
        else if (Input.GetKey(KeyCode.A))
        {
            transform.Translate(-moveSpeed * Time.deltaTime, 0, 0); // 角色向左移動
            render.flipX = true; // 圖像水平翻轉
            anim.SetBool("run", true); // 設定動畫為跑步
        }
        else
        {
            anim.SetBool("run", false); // 設定動畫為停止跑步
        }

        UpdateScore(); // 更新分數
    }

    // 碰撞觸發 (2D 碰撞)
    void OnCollisionEnter2D(Collision2D other)
    {
        // 普通階梯觸發
        if (other.gameObject.tag == "Normal")
        {
            if (other.contacts[0].normal == new Vector2(0f, 1f)) // 檢查是否從上方接觸
            {

                currentFloor = other.gameObject;
                ModifyHp(1); // 恢復血量
                other.gameObject.GetComponent<AudioSource>().Play(); // 播放音效
            }
        }
        // 釘子階梯觸發
        else if (other.gameObject.tag == "Nails")
        {
            if (other.contacts[0].normal == new Vector2(0f, 1f))
            {

                currentFloor = other.gameObject;
                ModifyHp(-3); // 減少血量
                anim.SetTrigger("hurt"); // 播放受傷動畫
                other.gameObject.GetComponent<AudioSource>().Play(); // 播放音效
            }
        }
        // 天花板觸發
        else if (other.gameObject.tag == "Ceiling")
        {

            currentFloor.GetComponent<BoxCollider2D>().enabled = false; // 停用階梯碰撞器
            ModifyHp(-3); // 減少血量
            anim.SetTrigger("hurt"); // 播放受傷動畫
            other.gameObject.GetComponent<AudioSource>().Play(); // 播放音效
        }
    }

    // 觸發區域 (例如死亡線)
    void OnTriggerEnter2D(Collider2D other)
    {
        if (other.gameObject.tag == "DeathLine") // 玩家掉入死亡區域
        {

            Die(); // 玩家死亡
        }
    }

    // 修改血量
    void ModifyHp(int num)
    {
        Hp += num; // 增加或減少血量

        if (Hp > 10) // 血量上限為10
        {
            Hp = 10;
        }
        else if (Hp <= 0) // 血量歸零觸發死亡
        {
            Hp = 0;
            Die();
        }

        UpdateHpBar(); // 更新血量條顯示
    }

    // 更新血量條
    void UpdateHpBar()
    {
        for (int i = 0; i < HpBar.transform.childCount; i++)
        {
            if (Hp > i) // 顯示對應血量的圖標
            {
                HpBar.transform.GetChild(i).gameObject.SetActive(true);
            }
            else // 隱藏多餘的圖標
            {
                HpBar.transform.GetChild(i).gameObject.SetActive(false);
            }
        }
    }

    // 更新分數
    void UpdateScore()
    {
        scoreTime += Time.deltaTime; // 增加分數計時器

        if (scoreTime > 2f) // 每2秒增加1分
        {
            score++;
            scoreTime = 0f; // 重置計時器
            scoreText.text = "地下" + score.ToString() + "層"; // 更新分數文字
        }
    }

    // 玩家死亡
    void Die()
    {
        deathSound.Play(); // 播放死亡音效
        Time.timeScale = 0f; // 暫停遊戲
        replayButton.SetActive(true); // 顯示重玩按鈕
    }

    // 重玩遊戲
    public void Replay()
    {
        Time.timeScale = 1f; // 恢復遊戲時間
        SceneManager.LoadScene("SampleScene"); // 重新加載場景
    }
}
